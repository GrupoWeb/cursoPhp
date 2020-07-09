<template>
    <div class="col-lg-9 my-4">
        <el-form ref="form" :model="form" >
            <el-form-item label="Identificador:">
                <el-input v-model="form.identificador"></el-input>
            </el-form-item>
            <el-form-item label="Descripción:">
                <el-input v-model="form.descripcion"></el-input>
            </el-form-item>
            <el-form-item label="Precio de Oferta:">
                <el-input v-model="form.precio"></el-input>
            </el-form-item>
            <el-form-item label="Imagen de Referencia">
                <el-upload 
                    :action="'/upload'" 
                    name="file[]" 
                    :headers="{ 'X-CSRF-TOKEN': csrf}"
                    :on-preview="handlePreview"
                    :on-remove="handleRemove"
                    :on-success="cargaSuccess"
                    :limit="1"
                    :on-exceed="handleExceed"
                    :file-list="fileList"
                    >
                        <el-button size="small" type="primary">Clic para subir archivo</el-button>
                        <div
                            slot="tip"
                            class="el-upload__tip"
                        >Solo archivos jpg/png con un tamaño menor de 500kb</div>
                    </el-upload>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">Guardar</el-button>
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
            },
            fileList:[],
            evento_id: ""

        }
    },
    methods: {
        handleRemove(file, fileList) {
            let vm = this
            axios.delete('/upload/' + file.uid)
                .then(function () {
                    let index = _.findIndex(vm.fileList, ['uid', file.uid])
                    vm.$delete(vm.fileList, index)
                })
                .catch(function (error) {
                    console.log(error);
                });
        }, 
        handlePreview(file) {
            console.log(file);
        },
        cargaSuccess(response, file, fileList) {
            let id_fila = ''
            var vm = this
                _.map(response, function (data) {
                    file['uid'] = data
                    
                })
                vm.fileList = fileList;
            
            // var url = "/Uploadfile";
            // axios
            //     .post(url, {
            //     id_evento: this.id,
            //     id_file: file.uid
            //     })
            //     .then(response => {
            //     this.$message.success(`Documento Cargado`);
            //     })
            //     .catch(error => {
            //     console.log(error.message);
            //     });
        },
        handleExceed(files, fileList) {
            this.$message.warning(
                `El límite es 3, haz seleccionado ${
                files.length
                } archivos esta vez, añade hasta ${files.length + fileList.length}`
            );
        },
        onSubmit() {
            
        }
    },
}
</script>