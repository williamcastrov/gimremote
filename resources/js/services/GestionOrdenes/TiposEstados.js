import url from "../../components/Url";
const baseUrl = `${url}/api/tiposestados`;
import axios from "axios";
const tiposestados = {};

tiposestados.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

tiposestados.listTiposEstados = async () => {
    const urlList = baseUrl+"/listar_tiposestados"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposestados.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_con
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposestados.delete = async (id_con) => {
    const urlDelete = baseUrl+"/delete/"+id_con
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default tiposestados;