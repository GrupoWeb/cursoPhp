<template>
        <div class="col-lg-9">

            <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                <img class="d-block img-fluid" src="img/slider/slider1.png" alt="First slide" width="900px" height="350px">
                </div>
                <div class="carousel-item">
                <img class="d-block img-fluid" src="img/slider/slider2.png"  alt="Second slide" width="900px" height="350px">
                </div>
                <div class="carousel-item">
                <img class="d-block img-fluid" src="img/slider/slider3.png"  alt="Third slide" width="900px" height="350px">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            </div>

            <div class="row">
                <div class="col-lg-12" v-if="(show_alert === true)">
                    <el-alert :title="alert_list.alert_data" type="warning" center show-icon></el-alert>
                </div>
                <div class="col-lg-4 col-md-6 mb-4"  v-for="(index, id) in response_list.response_oferta" :key="id">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" :src="`files/${ index.imgPath }`"  alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                            <a href="#">{{ index.nombre_oferta }}</a>
                            </h4>
                            <h5>Q {{ index.precio_oferta }}</h5>
                            <p class="card-text">{{ index.descripcion }}</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
</template>


<script>
export default {
    data() {
        return {
            publicPath: process.env.BASE_URL,
            request_list: {
                request_ofertas: 'getOfertas'
            },
            response_list: {
                response_oferta:[]
            },
            alert_list:{
                alert_data: "No se encontraron datos por el momento"
            },
            show_alert:false
        }
    },
    mounted() {
        this.getOfertas();
    },
    methods: {
        getOfertas() {
            axios.get(this.request_list.request_ofertas).then(response => {
                this.response_list.response_oferta = response.data
                this.show_alert = false;
                console.log(response.data); 
                if(response.data.length == 0){
                    this.show_alert = true;
                }
            }).catch(err => {
                this.show_alert = true;
            })
        }
    },
}
</script>