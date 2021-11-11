import url from "../../components/Url";
const baseUrl = `${url}/api/tiposfallas`;   
import axios from "axios";
const tiposfallas = {};

tiposfallas.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

tiposfallas.listTiposFallas = async () => {
    const urlList = baseUrl+"/listar_tiposfallas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposfallas.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_tfa
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposfallas.delete = async (id_tfa) => {
    const urlDelete = baseUrl+"/delete/"+id_tfa
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default tiposfallas;