import url from "../components/Url";
const baseUrl = `${url}/api/usuarios`;
import axios from "axios";
const usuarios = {};

usuarios.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

usuarios.listUsuarios = async () => {
    const urlList = baseUrl+"/listar_usuarios"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

usuarios.leerUsuario = async(email_usu) => {
    console.log("DATA USUARIO : ", email_usu)
    const urlList = baseUrl+"/leer_usuario/"+email_usu
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

usuarios.update = async (data) => {
    const urlUpdate = baseUrl+"/update/"+data.id_usu
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

usuarios.delete = async (id_usu) => {
    const urlDelete = baseUrl+"/delete/"+id_usu
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default usuarios;