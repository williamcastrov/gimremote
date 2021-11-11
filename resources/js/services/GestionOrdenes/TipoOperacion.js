import url from "../../components/Url";
const baseUrl = `${url}/api/tipooperacion`;   
import axios from "axios";
const tipooperacion = {};

tipooperacion.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

tipooperacion.listTipooperacion = async () => {
    const urlList = baseUrl+"/listar_tipooperacion"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tipooperacion.listTipooperacionEstados = async () => {
    const urlList = baseUrl+"/listar_tipooperacionestados"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tipooperacion.listTipooperacionChequeo = async () => {
    const urlList = baseUrl+"/listar_tipooperacionchequeo"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tipooperacion.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_tope
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tipooperacion.delete = async (id_tope) => {
    const urlDelete = baseUrl+"/delete/"+id_tope
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default tipooperacion;