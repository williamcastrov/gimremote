import url from "../../components/Url";
const baseUrl = `${url}/api/datoshorometro`;   
import axios from "axios";
const datoshorometro = {};

datoshorometro.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

datoshorometro.listdatoshorometro = async () => {
    const urlList = baseUrl+"/listar_datoshorometro"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

datoshorometro.listUnDatoHorometro = async (codigoequipo_dhr) => {
    const urlList = baseUrl+"/get/"+codigoequipo_dhr
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

datoshorometro.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_dhr
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

datoshorometro.delete = async (id_dhr) => {
    const urlDelete = baseUrl+"/delete/"+id_dhr
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default datoshorometro;