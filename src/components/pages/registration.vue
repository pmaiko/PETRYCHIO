<template>
    <div class="registration__page">
        <div class="form__registration">
            <div class="form__head">
                <div class="form__title">Форма регистрации</div>
            </div>
            <div class="form__body">
                <!--onsubmit="valid(this)"-->
                <form id="registrationForm" enctype="multipart/form-data">
                    <div class="form-group form-group--custom">
                        <label for="Name">Имя<span>*</span></label>
                        <div class="form__wrapper">
                            <i class="fa fa-user-o flex-shrink-0" aria-hidden="true"></i>
                            <input class="input__text"
                                   type="text"
                                   name="Name"
                                   id="Name"
                                   v-model="Name"
                                   ref="Name"
                                   :class="{'isError':isValid.Name === false,'isOk':isValid.Name === true}">
                        </div>
                    </div>

                    <div class="form-group form-group--custom">
                        <label for="LastName">Фамилия<span>*</span></label>
                        <div class="form__wrapper">
                            <i class="fa fa-gg flex-shrink-0" aria-hidden="true"></i>
                            <input class="input__text"
                                   type="text"
                                   name="LastName"
                                   id="LastName"
                                   v-model="LastName"
                                   ref="LastName"
                                   :class="{'isError':isValid.LastName === false,'isOk':isValid.LastName === true}">
                        </div>
                    </div>

                    <div class="form-group form-group--custom">
                        <label for="Email">Электронная почта<span>*</span></label>
                        <div class="form__wrapper">
                            <i class="fa fa-envelope-open-o flex-shrink-0" aria-hidden="true"></i>
                            <input class="input__text"
                                   type="text"
                                   name="Email"
                                   id="Email"
                                   v-model="Email"
                                   ref="Email"
                                   :class="{'isError':isValid.Email === false,'isOk':isValid.Email === true}">
                        </div>
                    </div>
                    <div class="form-group form-group--custom">
                        <label for="filename">Фотография</label>
                        <input class="input__text input__text--custom"
                               type="file"
                               name="filename"
                               id="filename">
                    </div>
                    <div class="form-group form-group--custom">
                        <label for="Login">Логин<span>*</span></label>
                        <div class="form__wrapper">
                            <i class="fa fa-address-card-o flex-shrink-0" aria-hidden="true"></i>
                            <input class="input__text"
                                   type="text"
                                   name="Login"
                                   id="Login"
                                   v-model="Login"
                                   ref="Login"
                                   :class="{'isError':isValid.Login === false,'isOk':isValid.Login === true}">
                        </div>
                    </div>

                    <div class="form-group form-group--custom">
                        <label for="Password">Пароль<span>*</span></label>
                        <div class="form__wrapper">
                            <i class="fa fa-key flex-shrink-0" aria-hidden="true"></i>
                            <input class="input__text"
                                   type="password"
                                   name="Password"
                                   id="Password"
                                   v-model="Password"
                                   ref="Password"
                                   :class="{'isError':isValid.Password === false,'isOk':isValid.Password === true}">
                        </div>
                    </div>

                    <div class="form-group form-group--custom">
                        <label for="SecondPassword">Введите пароль еще раз<span>*</span></label>
                        <div class="form__wrapper">
                            <i class="fa fa-keyboard-o flex-shrink-0" aria-hidden="true"></i>
                            <input class="input__text"
                                   type="password"
                                   name="SecondPassword"
                                   id="SecondPassword"
                                   v-model="RepeatPassword"
                                   ref="RepeatPassword"
                                   :class="{'isError':isValid.RepeatPassword === false,'isOk':isValid.RepeatPassword === true}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form__error">

                        </div>
                    </div>
                    <!--name="submit"-->
                    <div class="form-group d-flex justify-content-between">
                        <input type="button"
                               class="btn__red"
                               value="Зарегистрироваться"
                               @click="regist">
                        <router-link to="/login" class="btn__darkBlue">Отмена</router-link>
                    </div>
                </form>
            </div>
        </div>
        <b-modal ref="message" title="BootstrapVue">
            {{message}}
        </b-modal>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                Name: '',
                LastName: '',
                Email: '',
                Login: '',
                Password: '',
                RepeatPassword: '',
                isValid: {
                    Name: '',
                    LastName: '',
                    Email: '',
                    Login: '',
                    Password: '',
                    RepeatPassword: '',
                },

                message: '',
            };
        },
        methods: {
            showModal() {
                this.$refs.message.show();
            },



            regist() {
                if (this.validate) {
                    const data = new FormData(document.getElementById('registrationForm'));
                    const imageFile = document.querySelector('#filename');
                    // data.append('file', imageFile.files[0]);

                    axios.post('/api/registration.php', data, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then(response => {
                            console.log(response)
                            this.message = response;
                        })
                        .catch(error => {
                            console.log(error.response)
                        });

                    this.showModal();
                }
            }
        },

        computed: {
            validate() {
                this.isValid.Name = '';
                this.isValid.LastName = '';
                this.isValid.Email = '';
                this.isValid.Login = '';
                this.isValid.Password = '';
                this.isValid.RepeatPassword = '';
                const pattern  = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
                if (this.Name === '' || this.Name === ' ') {
                    this.isValid.Name = false;
                }
                else if (this.LastName === '' || this.Name === ' ') {
                    this.isValid.LastName = false;
                }

                else if (pattern.test(this.Email) === false) {
                    this.isValid.Email = false;
                }
                else if (this.Login === '' || this.Login === ' ') {
                    this.isValid.Login = false;
                }

                else if (this.Password === '' || this.Password === ' ') {
                    this.isValid.Password = false;
                }
                else if (this.RepeatPassword === '' || this.RepeatPassword === ' ' || this.RepeatPassword !== this.Password) {
                    this.isValid.RepeatPassword = false;
                }
                else {
                    this.isValid.Name = true;
                    this.isValid.LastName = true;
                    this.isValid.Email = true;
                    this.isValid.Login = true;
                    this.isValid.Password = true;
                    this.isValid.RepeatPassword = true;
                    return true;
                }
            },

        },

        watch: {
            //validate() {},
        }
    }

    function valid(form) {
        var pattern  = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var name = form.Name.value;
        var last_name = form.LastName.value;
        var email = form.Email.value;
        var login = form.Login.value;
        var password = form.Password.value;
        var secondPassword = form.SecondPassword.value;
        var style_input_text_ok = 'border-bottom: 1px solid #24c482;';
        var style_input_text_error = 'border-bottom: 1px solid #ff3048;';
        if (name === '' || name === ' ') {
            form.Name.style = style_input_text_error;
            event.preventDefault();
        }
        else {
            form.Name.style = style_input_text_ok;
        }
        if (last_name === '' || last_name === ' ') {
            form.LastName.style = style_input_text_error;
            event.preventDefault();
        }
        else {
            form.LastName.style = style_input_text_ok;
        }
        if (pattern.test(email) === false) {
            form.Email.style = style_input_text_error;
            event.preventDefault();
        }
        else {
            form.Email.style = style_input_text_ok;
        }
        if (login === '' || login === ' ') {
            form.Login.style = style_input_text_error;
            event.preventDefault();
        }
        else {
            form.Login.style = style_input_text_ok;
        }

        if (password === '' || password === ' ') {
            form.Password.style = style_input_text_error;
            event.preventDefault();
        }
        else {
            form.Password.style = style_input_text_ok;
        }
        if (secondPassword !== password || secondPassword === '' || secondPassword === ' ') {
            form.SecondPassword.style = style_input_text_error;
            event.preventDefault();
        }
        else {
            form.SecondPassword.style = style_input_text_ok;
        }
    }
</script>
