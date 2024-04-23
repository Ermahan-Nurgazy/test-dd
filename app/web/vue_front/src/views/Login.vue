<template>
  <v-container grid-list-xl text-xs-center class="login-page">
    <v-layout row justify-center>
      <v-flex xs4>
        <div class="enter_system">Вход в сервис</div>
      </v-flex>
    </v-layout>
    <v-layout row justify-center>
      <v-flex lg3>
        <v-form @submit.prevent="onSubmit" class="form-login">

          <v-text-field
              v-model="login"
              autocomplete="off"
              outlined
              class="input"
              placeholder="Почта"
              :error-messages="errors.login"
              :error="!!errors.login"
          >
          </v-text-field>

          <v-text-field
              v-model="password"
              :append-icon="value ? 'mdi-eye-outline' : 'mdi-eye-off-outline'"
              @click:append="() => (value = !value)"
              :type="value ? 'password' : 'text'"
              outlined
              placeholder="Пароль"
              color="secondary"
              class="input password-input"
              :error-messages="errors.password"
              :error="!!errors.password"
          >
          </v-text-field>

          <v-btn type="submit" class="button mt-6" style="height: 48px !important;">
            Войти
          </v-btn>
        </v-form>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import { mapState } from 'vuex'
import router from '@/router/index'
import { actionTypes } from '@/store/modules/auth'

export default {
  name: 'Login',
  data() {
    return {
      login: '',
      errors: {
        login: null,
        password: null,
      },
      password: '',
      remember: false,
      value: String,
      dialog: false
    }
  },
  computed: {
    ...mapState({
      isSubmitting: state => state.auth.isSubmitting,
      validationErrors: state => state.auth.validationErrors
    })
  },
  methods: {
    onSubmit() {
      this.$store.dispatch(actionTypes.login, {
        login: this.login,
        password: this.password
      })
          .then(() => {
            router.push({ path: '/main' });
          })
    }
  },
  watch: {
    validationErrors: function (value) {
      if (value) {
        this.$set(this, 'errors', {
          login: 'Неверное имя пользователя',
          password: 'Неверный пароль',
        })
      }
    }
  }
}
</script>

<style scoped lang="scss">
.login-page {
  .button {
    width: 100% !important;
    background-color: #629F33 !important;
    border-radius: 12px !important;
    color: #FFFFFF !important;
  }

  .input {
    border-radius: 12px !important;

  }

  .enter_system {
    font-style: normal;
    font-weight: 700;
    font-size: 20px;
    line-height: 24px;
    margin-top: 131px;
    text-align: center;
  }

  .v-input--checkbox {
    .v-label {
      color: #1A1A1A;
      font-family: 'Circe',sans-serif;
      font-style: normal;
      font-weight: 400;
      font-size: 16px;
      line-height: 24px;
    }
  }

  .form-login {
    .v-text-field__details {
      padding-left: 0 !important;
    }

    .v-input__slot {
      border: none !important;
    }

    .password-input {
      &.error--text {
        fieldset {
          &::after {
            right: 45px !important;
          }
        }

        .v-icon {
          color: #767676 !important;
        }
      }
    }


    .v-text-field--outlined {
      &.error--text {
        fieldset {
          border: 1px solid #D53025 !important;

          &::after {
            content: "";
            width: 20px;
            height: 20px;
            display: block;
            position: absolute;

            background-image: url('../assets/warning-icon.svg');
            background-size: cover;
            right: 18px;
            top: -3px;
            bottom: 0;
            margin: auto;
            z-index: 2;
          }
        }
      }

      fieldset {
        border: 1px solid #E0E0E0 !important;
      }
    }

    button {
      &[type="submit"] {
        box-shadow: none !important;
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 24px;
        margin-top: 0!important;
      }
    }
  }
}
</style>

