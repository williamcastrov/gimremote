import url from "../../components/Url";
const baseUrl = `${url}/api/tiposmtto`;   
import axios from "axios";
const tiposmtto = {};

tiposmtto.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

tiposmtto.listTiposmtto = async () => {
    const urlList = baseUrl+"/listar_tiposmtto"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposmtto.listTiposmttoOT = async () => {
    const urlList = baseUrl+"/listar_tiposmttoOT"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposmtto.listTiposmttoAlistamiento = async () => {
    const urlList = baseUrl+"/listar_tiposlistar_tiposmttoalistamiento"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposmtto.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_tmt
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposmtto.delete = async (id_tmt) => {
    const urlDelete = baseUrl+"/delete/"+id_tmt
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default tiposmtto;