function create(){
    if(txtCategoria.value!=""){
        let url = "/categorias"
        axios
            .post(url,{
                'catNombre': txtCategoria.value,
            })
            .then(function (response) {
                if(response.data.estado){
                    listar()
                    txtCategoria.value = "";
                    Swal.fire('Agregar Categoria',response.data.mensaje,'success')
                }else{
                    Swal.fire('Agregar Categoria',response.data.mensaje,'error')
                }
            })
    }else{
        Swal.fire('Agregar Categoria','Faltan Datos','info')
    }
}
function update(){
    if(document.getElementById('txtUpCategoria').value!=""){
        let id = localStorage.id
        let url = `/categorias/${id}`
        axios.put(url,{
            'catNombre': document.getElementById('txtUpCategoria').value,
        }).then(function (response) {
            console.log(response);
            if(response.data.estado){
                listar()
                Swal.fire('Actualizar categoria',response.data.mensaje,'success')
            }else{
                Swal.fire('Actualizar categoria',response.data.mensaje,'error')
            }
        })
    }else{
        Swal.fire('Actualizar categoria','Faltan datos','info')
    }
}
function deletes(){
    let id = localStorage.id
    let url = `/categorias/${id}`
    axios.delete(url)
    .then(function (response) {
        if(response.data.estado){
            listar()
            Swal.fire('Eliminar Categoria',response.data.mensaje,'success')
        }else{
            Swal.fire('Eliminar Categoria',response.data.mensaje,'error')
        }
    })
}
function listar(){
    let url = "/categorias"
    axios.get(url)
    .then(function (response) {
            let table = ""
            response.data.forEach((element,index) => {
                table+=`<tr>
                    <th scope="row">${index+1}</th>
                    <td>${element.catNombre}</td>
                    <td>
                        <button type="button" class="btn btn-warning" onclick="ConsultarCategoria(${element.id})"data-bs-toggle="modal" data-bs-target="#modalActualizar">Actualizar</button>
                        <button type="button" class="btn btn-danger" onclick="ConsultarCategoria(${element.id})"data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
                    </td>
                </tr>`
                tblCategorias.innerHTML=table
            });
    })
}
function ConsultarCategoria(id){
    let url = `/categorias/${id}`
    axios.get(url).then(function(response){
        console.log(response)
        document.getElementById('txtUpCategoria').value = response.data.catNombre
        document.getElementById('mensajeEliminar').innerHTML = `¿Esta seguro de eliminar la categoria ${response.data.catNombre}?`
        localStorage.id = response.data.id
    })
}
listar()