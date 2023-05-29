function create(){
    let url = '/usuarios'
    axios.post(url,{
        'usuNombre': txtNombreUser.value,
        'usuContraseña': txtContraseña.value,
        'usuCorreo': txtCorreo.value,
    }).then(function(response){
        if(response.data.estado){
            Swal.fire('Registro',response.data.mensaje,'success')
            location.assign('/')
        }else{
            Swal.fire('Registro',response.data.mensaje,'error')
        }
    })
}
function iniciarSesion(){
    let url = `/iniciarSesion/${txtNombreUser.value}/${txtContraseña.value}`
    axios.get(url).then(function(response){
        console.log(response)
        if(response.data.estado){
            location.assign('/gestionArticulos')
        }else{
            Swal.fire('Iniciar sesion',response.data.mensaje,'warning')
        }
    })
}