import url from "../components/Url";
const baseUrl = `${url}/api/empresa`;
import axios from "axios";
const empresa = {};

empresa.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

empresa.listEmpresas = async () => {
    const urlList = baseUrl+"/listar_empresa"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

empresa.update = async (data) => {
    const urlUpdate = baseUrl+"/update/"+data.id_emp
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

empresa.delete = async (id_emp) => {
    const urlDelete = baseUrl+"/delete/"+id_emp
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default empresa;