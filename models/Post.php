<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $audio_file
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property PostTag[] $postTags
 * @property Tag[] $tags
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 'Активный';
    public const STATUS_INACTIVE = 'Не активный';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'audio_file'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'audio_file'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'audio_file' => 'Audio File',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    /**
     * @param UploadedFile $file
     * @return string
     */
    public function uploadAudioFile(UploadedFile $file)
    {
        $filePath = 'uploads/'. uniqid() . '.mp3';

        if (!$file->saveAs($filePath)) {
            return false;
        }

        $this->compressAudioFile($filePath);

        return $filePath;
    }

    /**
     * @param string $filePath
     * @return void
     */
    private function compressAudioFile(string $filePath)
    {
        $compressedFilePath = str_replace('.mp3', '_compressed.mp3', $filePath);
        $command = "ffmpeg -i $filePath -b:a 128k $compressedFilePath";
        shell_exec($command);
        unlink($filePath);
        rename($compressedFilePath, $filePath);
    }


    /**
     * @param array $tags
     * @return void
     */
    public function addTags(array $tags)
    {
        $this->unlinkAll('tags', true);
        foreach ($tags as $tagName) {
            $tag = Tag::findOne(['name' => $tagName]);
            if (!$tag) {
                $tag = new Tag(['name' => $tagName]);
                $tag->save();
            }
            $this->link('tags', $tag);
        }
    }

    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('post_tag', ['post_id' => 'id']);
    }

    /**
     * Gets query for [[PostTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::class, ['post_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
