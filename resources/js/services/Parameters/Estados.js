import url from "../../components/Url";
const baseUrl = `${url}/api/estados`;
import axios from "axios";
const estados = {};

estados.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

estados.listEstados = async () => {
    const urlList = baseUrl+"/listar_estados"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.listEstadosGenerales = async () => {
    const urlList = baseUrl+"/listar_estadosgenerales"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.listEstadosPendientes = async () => {
    const urlList = baseUrl+"/listar_estadospendientes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.listEstadosOT = async () => {
    const urlList = baseUrl+"/listar_estadosOT"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.listEstadosContratos = async () => {
    const urlList = baseUrl+"/listar_estadoscontratos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.listEstadosSeguros = async () => {
    const urlList = baseUrl+"/listar_estadosseguros"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.listEstadosEquipos = async () => {
    const urlList = baseUrl+"/listar_estadosequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.listEstadosEquiposOperacion = async () => {
    const urlList = baseUrl+"/listar_estadosequipooperacion"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_est
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estados.delete = async (id_est) => {
    const urlDelete = baseUrl+"/delete/"+id_est
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default estados;