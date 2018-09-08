<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <loading v-show="isLoading"></loading>
                    <div v-show="isLoading">
                        <h4 class="text-light">Estamos rastreando. Aguarde{{ dots }}</h4>
                        <h6 class="text-light" v-show="demorando">Ops... Tá demorando mais do que o normal</h6>
                        <h6 class="text-light" v-show="demorando">Sites muito populares tendem a demorar um pouco...</h6>
                    </div>
                    <div v-show="error">
                        <h5>Desculpe-nos te decepcionar.</h5>
                        <h5>Esse site é muita areia para o nosso caminhãozinho :(</h5>
                        <h6>A gente tá melhorando nosso buscador. Tente novamente mais tarde, ok?</h6>
                    </div>

                    <div v-show="!isLoading">
                        <div v-for="(sites, index) in resultado">
                            <div class="card">
                                <div class="card-header font-weight-bold">
                                    Registro {{ index+1 }}
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-left" v-for="(item, index) in sites">{{ index+1 }} - {{ item }}</li>
                                </ul>
                            </div>
                            <hr></hr>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['idurl'],
        mounted() {
            this.retrieve();
        },
        data () {
            return {
                resultado: {},
                demorando: false,
                isLoading: true,
                status: 50,
                dots: ".",
                error: false
            }
        },
        methods: {
            retrieve: function () {
                self = this;
                self.error = false;
                self.isLoading = true;
                self.demorando = false;

                setInterval(function() {
                    if (self.dots.length < 3) {
                        self.dots = self.dots + ".";
                    } else {
                        self.dots = "";
                    }
                }, 1000);

                setTimeout(function () {
                    self.demorando = true;
                }, 15000);

                axios.post('/getinfo/'+self.idurl)
                    .then(function (response) {
                        self.isLoading = false;
                        self.resultado = response.data;

                    })
                    .catch(function (error) {
                        console.log(error);
                        self.error = true;
                        self.isLoading = false;
                    });
            },
        }

    }
</script>

<style scoped>
    div, ul, li {
        background-color: black;
    }
    li {
        color: white !important;
    }
    .card, .card-header {
        border-color: #EB5160;
    }
</style>
