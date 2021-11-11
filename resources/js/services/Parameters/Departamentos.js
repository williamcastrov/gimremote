import url from "../../components/Url";
const baseUrl = `${url}/api/departamentos`;
import axios from "axios";
const departamentos = {};

departamentos.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

departamentos.listDepartamentos = async () => {
    const urlList = baseUrl+"/listar_departamentos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

departamentos.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_dep
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

departamentos.delete = async (id_dep) => {
    const urlDelete = baseUrl+"/delete/"+id_dep
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default departamentos;