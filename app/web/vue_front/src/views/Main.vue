<template>
  <div></div>
</template>

<script>
import {mapState} from "vuex";
export default {
  name: 'Main',
  components: {

  },
  data() {
    return {

    }
  },
  computed: {
    ...mapState({
      userType: state => state.userType,
    })
  },
  methods: {

  },
}
</script>

<style scoped>

</style>