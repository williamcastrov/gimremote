import url from "../../components/Url";
const baseUrl = `${url}/api/estadoscalidad`;
import axios from "axios";
const estadoscalidad = {};

estadoscalidad.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

estadoscalidad.listEstadosCalidad = async () => {
    const urlList = baseUrl+"/listar_estadoscalidad"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estadoscalidad.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_estcal
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estadoscalidad.delete = async (id_estcal) => {
    const urlDelete = baseUrl+"/delete/"+id_estcal
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default estadoscalidad;