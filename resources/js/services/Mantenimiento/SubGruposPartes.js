import url from "../../components/Url";
const baseUrl = `${url}/api/subgrupospartes`;
import axios from "axios";
const subgrupospartes = {};

subgrupospartes.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

subgrupospartes.listSubGrupospartes = async () => {
    const urlList = baseUrl+"/listar_subgrupospartes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.listUnSubGrupopartes = async (id_sgre) => {
    const urlList = baseUrl+"/get/"+id_sgre
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.listSubGrupospartesequipos = async () => {
    const urlList = baseUrl+"/listar_subgrupospartesequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.listConsecutivoContratos = async () => {
    const urlList = baseUrl+"/listar_consecutivocontratos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.listConsecutivoSeguros = async () => {
    const urlList = baseUrl+"/listar_consecutivoseguros"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.listSubGrupospartescomponentes = async () => {
    const urlList = baseUrl+"/listar_subgrupospartescomponentes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_sgre
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.actualizaConsecutivo = async (consecutivo) => {
    console.log("DATA EN SERVICIES : ",consecutivo);
    const urlUpdate = baseUrl+"/actualizaconsecutivo/"+consecutivo
    const res = await axios.put(urlUpdate, consecutivo)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

subgrupospartes.delete = async (id_sgre) => {
    const urlDelete = baseUrl+"/delete/"+id_sgre
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default subgrupospartes;