import url from "../../components/Url";
const baseUrl = `${url}/api/fallasmtto`;   
import axios from "axios";
const fallasmtto = {};

fallasmtto.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

fallasmtto.listfallasmtto = async () => {
    const urlList = baseUrl+"/listar_fallasmtto"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

fallasmtto.leerFallaTipo = async (tipodefalla_fmt) => {
    const urlList = baseUrl+"/leerfallatipo/"+tipodefalla_fmt
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

fallasmtto.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_fmt
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

fallasmtto.delete = async (id_fmt) => {
    const urlDelete = baseUrl+"/delete/"+id_fmt
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default fallasmtto;