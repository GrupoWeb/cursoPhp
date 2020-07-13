<template>
    <div class="col-lg-9 my-4">
        <el-form ref="form" :model="form" >
            <el-form-item label="Identificador:" prop="identificador" :rules ="[{ required: true, message: 'Coloque un identificador' , trigger: 'blur'}]">
                <el-input v-model="form.identificador"></el-input>
            </el-form-item>
            <el-form-item label="Descripción:" prop="descripcion" :rules="[{ required: true, message: 'Coloque una descripcion' , trigger: 'blur'}]">
                <el-input v-model="form.descripcion"></el-input>
            </el-form-item>
            <el-form-item label="Precio de Oferta:" prop="precio" :rules="[{ required: true, message: 'Coloque un precio' , trigger: 'blur'}]">
                <el-input v-model="form.precio"></el-input>
            </el-form-item>
            <el-form-item label="Imagen de Referencia" prop="fileList" >
                <el-upload 
                    ref="uploadFile"
                    action="upload"
                    name="file[]" 
                    :headers="{ 'X-CSRF-TOKEN': csrf}" 
                    :auto-upload="false"
                    :limit="1"
                    :on-exceed="handleExceed"
                    :file-list="form.fileList"
                    list-type="picture" 
                    >
                        <el-button size="small" type="primary">Clic para subir archivo</el-button>
                        <div
                            slot="tip"
                            class="el-upload__tip"
                        >Solo archivos jpg/png con un tamaño menor de 500kb</div>
                    </el-upload>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit('form')">Guardar</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
export default {
    props: {
        csrf: {type: String}
    },
    data() {
        return {
            form: {
                identificador: "",
                descripcion: "",
                precio: "",
                fileList:[],
            },
            evento_id: "",
            request_list:{
                request_upload: 'uploadfile'
            }


        }
    },
    methods: {
        // handleRemove(file, fileList) {
        //     let vm = this
        //     axios.delete('/upload/' + file.uid)
        //         .then(function () {
        //             let index = _.findIndex(vm.fileList, ['uid', file.uid])
        //             vm.$delete(vm.fileList, index)
        //         })
        //         .catch(function (error) {
        //             console.log(error);
        //         });
        // }, 
        // handlePreview(file) {
        //     console.log(file);
        // },
        cargaSuccess(response, file, fileList) { 
            
            
            var url = "/Uploadfile";
            axios
                .post(url, {
                id_evento: this.id,
                id_file: file.uid
                })
                .then(response => {
                this.$message.success(`Documento Cargado`);
                })
                .catch(error => {
                console.log(error.message);
                });
        },
        handleExceed(files, fileList) {
            this.$message.warning(
                `El límite es 3, haz seleccionado ${
                files.length
                } archivos esta vez, añade hasta ${files.length + fileList.length}`
            );
        },
        onSubmit(form) {
            
            this.$refs[form].validate((valid) => {
                if(valid){
                    // axios.post(request_list.request_upload,{

                    // })
                    // console.log(this.file);
                    this.$refs.uploadFile.submit();
                }
            })
        }
    },
}
</script>