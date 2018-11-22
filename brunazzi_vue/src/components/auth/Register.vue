<template>
    <section id="one" class="wrapper spotlight style1">
      <div class="inner">
        <div class="content">
          <h2 class="major">Inscription</h2>
          <form method="post" action="#">
              <div class="fields">
                  <div class="field">
                      <label for="email">Adresse e-mail</label>
                      <input type="email" v-model="email" name="email" id="email" />
                  </div>
                  <div class="field">
                      <label for="username">Nom d'utilisateur</label>
                      <input type="text" v-model="username" name="username" id="username" />
                  </div>
                  <div class="field">
                      <label for="password">Mot de passe</label>
                      <input type="text" v-model="password" v-on:keyup.enter="signUp" name="password" id="password"/>
                  </div>
              </div>
              <ul class="actions">
                  <li><button type="button" v-on:click="signUp" value="S'inscrire">S'inscrire</button></li>
                  <li>
                      <router-link to="/signin" type="button" class="button">Déjà inscrit ?</router-link>
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
    name: 'Register',
    data: function () {
        return {
            email: '',
            username: '',
            password: '',
        }
    },
    methods: {
        signUp: function() {
            AuthService.SignUp(this.email, this.username, this.password)
                .then(res => {
                    let response = res.data;
                    if (response.token) {
                        cookies.set('jwt_token', response.token, { httponly: true });
                        this.flash('Inscription réussie !', 'success')
                    }
                    this.$router.push('/');
                })
                .catch(err => {
                    let response = err.response;

                    if (response.status && response.status !== 200) {
                        // Any specific error
                        if (response.data.error) {
                            this.flash(response.data.error, 'error')
                        }

                        // Validation error
                        let rule = response.data[0];
                        if (rule) {
                            this.flash(`${rule.message} !`, 'error')
                        }
                    }
                })
        },
    }
}
</script>
