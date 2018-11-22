<template>
  <section id="one" class="wrapper spotlight style1">
    <div class="inner">
      <div class="content">
        <h2 class="major">Connexion</h2>
        <form method="post" action="#">
          <div class="fields">
            <div class="field">
              <label for="email">Adresse e-mail</label>
              <input type="email" v-model="email" id="email" />
            </div>
            <div class="field">
              <label for="password">Mot de passe</label>
              <input type="password" v-model="password" v-on:keyup.enter="signIn" id="password"/>
            </div>
          </div>
          <ul class="actions">
            <li><button type="button" v-on:click="signIn" value="Connexion">Connexion</button></li>
            <li>
              <router-link to="/signup" type="button" class="button">S'enregistrer</router-link>
            </li>
          </ul>
        </form>
      </div>
    </div>
  </section>
</template>

<script>
import cookies from 'browser-cookies'
import AuthService from '../../services/AuthService'

export default {
  name: 'Login',
  data: function () {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    signIn: function() {
      AuthService.SignIn(this.email, this.password)
      .then(res => {
        let response = res.data;
        if (response.token) {
          // Removed http_only because of a bug
          cookies.set('jwt_token', response.token);
          this.flash('Authentification réussie !', 'success');
        }
        this.$router.push('/')
      })
      .catch(err => {
        let response = err.response;

        if (response.status && response.status === 401) {
          //Wrong credentials
          if (response.data.error) {
            this.flash(response.data.error, 'error')
          }

          //validation rules error
          let rule = response.data[0];
          if (rule) {
            this.flash(`${rule.message} !`, 'error')
          }
        }
      })
    }
  }
}
</script>
