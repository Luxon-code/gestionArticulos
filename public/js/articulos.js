function listarArticulos(){
    let url = '/articulos'
    axios.get(url).then(function(response){
        let table = ""
        response.data.forEach((element,index) => {
            table += `<tr>
                <th scope="row">${index+1}</th>
                <td>${element.artCodigo}</td>
                <td>${element.artNombre}</td>
                <td>${element.artPrecio}</td>
                <td>${element.catNombre}</td>
                <td>
                    <button type="button" class="btn btn-warning" onclick="consultarArticulo(${element.id})" data-bs-toggle="modal" data-bs-target="#modalArticulo">Actualizar</button>
                    <button type="button" class="btn btn-danger" onclick="consultarArticulo(${element.id})"data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
                </td>
            </tr>`
            tblArticulos.innerHTML = table
        });
    })
}
function listarCategorias(){
    let url = '/categorias'
    axios.get(url).then(function(response){
        let categorias = ""
        response.data.forEach(element => {
            categorias += `<option value="${element.id}">${element.catNombre}</option>`
            cbCategoria.innerHTML = categorias
            cbUpCategoria.innerHTML = categorias
        });
    })
}
function create(){
    if(txtCodigo.value!="",txtNombre.value!="",txtPrecio.value!=""){
        let url = '/articulos'
        axios.post(url,{
            'artCodigo':txtCodigo.value,
            'artNombre':txtNombre.value,
            'artPrecio':txtPrecio.value,
            'artCategoria':cbCategoria.value,
        }).then(function(response){
        if(response.data.estado){
            txtCodigo.value = ""
            txtNombre.value = ""
            txtPrecio.value = ""
            listarArticulos()
            Swal.fire('Agregar Articulo',response.data.mensaje,'success')
        }else{
                Swal.fire('Agregar Articulo',response.data.mensaje,'error')
        }
        })
    }else{
        Swal.fire('Agregar Articulo','Faltan Datos','info')
    }
}
function consultarArticulo(id){
    let url = `/articulos/${id}`
    axios.get(url).then(function(response){
        console.log(response)
        document.getElementById('txtUpCodigo').value = response.data.artCodigo
        document.getElementById('txtUpNombre').value = response.data.artNombre
        document.getElementById('txtUpPrecio').value = response.data.artPrecio
        document.getElementById('cbUpCategoria').value = response.data.artCategoria
        mensajeEliminar.innerHTML = `¿Esta seguro que quiere eliminar el Articulo ${response.data.artNombre}?`
        localStorage.id = response.data.id
    })
}

function update(){
    if(document.getElementById('txtUpCodigo').value !="",document.getElementById('txtUpNombre').value!="",
    document.getElementById('txtUpPrecio').value!=""){
        let id = localStorage.id
        let url = `/articulos/${id}`
        axios.put(url,{
            'artCodigo':document.getElementById('txtUpCodigo').value,
            'artNombre':document.getElementById('txtUpNombre').value,
            'artPrecio':document.getElementById('txtUpPrecio').value,
            'artCategoria':document.getElementById('cbUpCategoria').value,
        }).then(function(response){
            if(response.data.estado){
                listarArticulos()
                Swal.fire('Actualizar Articulo',response.data.mensaje,'success')
            }else{
                Swal.fire('Actualizar Articulo',response.data.mensaje,'error')
            }
        })
    }else{
        Swal.fire('Actualizar Articulo','Faltan Datos','info')
    }
}
function deletes(){
    let id = localStorage.id
    let url = `/articulos/${id}`
    axios.delete(url).then(function(response){
        if(response.data.estado){
            listarArticulos()
            Swal.fire('Eliminar Articulo',response.data.mensaje,'success')
        }else{
            Swal.fire('Eliminar Articulo',response.data.mensaje,'error')
        }
    })
}
listarCategorias()
listarArticulos()