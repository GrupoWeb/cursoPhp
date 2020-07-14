<template>
    <div class="col-lg-9 my-4">
        <el-form ref="form" :model="form" >
            <el-form-item label="Nit:" prop="nit" :rules ="[{ required: true, message: 'Coloque un nit' , trigger: 'blur'}]">
                <el-input v-model="form.nit"></el-input>
            </el-form-item>
            <el-form-item label="Nombre de Cliente:" prop="nombre" :rules="[{ required: true, message: 'Coloque un nombre' , trigger: 'blur'}]">
                <el-input v-model="form.nombre"></el-input>
            </el-form-item>
            <el-form-item label="Dirección:" prop="direccion" :rules="[{ required: true, message: 'Coloque una dirección' , trigger: 'blur'}]">
                <el-input v-model="form.direccion"></el-input>
            </el-form-item>
            <el-form-item label="Teléfono:" prop="telefono" :rules="[{ required: true, message: 'Coloque un Teléfono' , trigger: 'blur'}]">
                <el-input v-model="form.telefono"></el-input>
            </el-form-item>
            <el-form-item label="Paquete:" prop="paquete" :rules="[{ required: true, message: 'Seleccione un Paquete' , trigger: 'blur'}]">
                <el-select v-model="form.paquete" placeholder="Seleccione" style="width:100%;">
                    <el-option v-for="(index, id) in response_list.response_paquete" :key="id" :label="index.nombre_oferta" :value="index.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item>
                <el-button type="success" @click="onSubmit('form')">Guardar</el-button>
                <el-button type="info" @click="resetForm('form')">Cancelar</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
export default {

    data() {
        return {
            form: {
                nit: "",
                nombre: "",
                direccion: "",
                telefono:"",
                paquete:"",
            },
            request_list:{
                request_cliente: 'paquetes',
                request_paquete: 'paquetes',
            },
            response_list:{
                response_paquete:[]
            },
            


        }
    },
    mounted() {
        this.getPaquete();
    },
    methods: {
        getPaquete() {
            axios.get(this.request_list.request_paquete).then(response => {
                this.response_list.response_paquete = response.data;
                
            })
        },
        onSubmit(form) {
            
            this.$refs[form].validate((valid) => {
                if(valid){
                    axios.post(this.request_list.request_cliente,{
                        nombre: this.form.nombre,
                        nit: this.form.nit,
                        direccion: this.form.direccion,
                        telefono: this.form.telefono,
                        paquete: this.form.paquete
                    }).then(response => {
                        const status = JSON.parse(response.status);

                        if (status == "200") {
                            this.resetForm('form');
                            this.$notify({
                                title: 'Success',
                                message: 'Agendado',
                                type: 'success'
                                });
                        }else{
                            this.$notify.error({
                            title: 'error',
                            message: 'No se puede almacenar el dato por el momento.',
                            });
                        }
                    }).catch(err => {
                        this.$notify.error({
                        title: 'error',
                        message: 'No se puede almacenar el dato por el momento.',
                        });
                    })
                }
            })
        },
        resetForm(form){
            this.$refs[form].resetFields();
        }
    },
}
</script>