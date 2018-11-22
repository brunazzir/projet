<template>
  <div>
    Logout from JoggingGeneva
  </div>
</template>
<script>
import cookies from 'browser-cookies';
import router from '../../router';

export default {
  name: 'Logout',
  data: function () {
    return {
      token: cookies.get('jwt_token'),
    }
  },
  methods: {
    logOut: function() {
      console.log('Tried to logout');
      // TO DEVELOPP :)
    },
  },
  created(){
    this.logOut()
  },
}
</script>
