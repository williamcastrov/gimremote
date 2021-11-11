import url from "../../components/Url";
const baseUrl = `${url}/api/unidades`;
import axios from "axios";
const unidades = {};

unidades.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

unidades.listUnidades = async () => {
    const urlList = baseUrl+"/listar_unidades"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

unidades.listTipopartes = async () => {
    const urlList = baseUrl+"/listar_tipopartes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

unidades.listTiposEquipos = async () => {
    const urlList = baseUrl+"/listar_tipoequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

unidades.listTipousuarios = async () => {
    const urlList = baseUrl+"/listar_tipousuarios"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

unidades.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_und
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

unidades.delete = async (id_und) => {
    const urlDelete = baseUrl+"/delete/"+id_und
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default unidades;