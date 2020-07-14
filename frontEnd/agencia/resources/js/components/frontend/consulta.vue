<template>
    <div class="col-lg-9 my-4">
        <el-table :data="response_list.response_paquete">
            <el-table-column label="Nit:" prop="nit"></el-table-column>
            <el-table-column label="Nombre:" prop="nombre_persona"></el-table-column>
            <el-table-column label="Dirección:" prop="direccion"></el-table-column>
            <el-table-column label="Teléfono:" prop="telefono"></el-table-column>
            <el-table-column label="Estado:" prop="estado">
                <template slot-scope="scope">                 
                    <div v-if="scope.row.estado == 'A'">
                        Activo    
                    </div> 
                    <div v-else>
                        Inactivo    
                    </div> 
                </template>
            </el-table-column>
            <el-table-column label="Paquete:" prop="nombre_oferta"></el-table-column>
        </el-table>
    </div>
</template>

<script>
export default {

    data() {
        return {
            request_list:{
                request_cliente: 'paquetes',
                request_paquete: 'getConsulta',
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
        }
    },
}
</script>