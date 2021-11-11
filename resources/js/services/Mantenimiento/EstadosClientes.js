import url from "../../components/Url";
const baseUrl = `${url}/api/estadosclientes`;
import axios from "axios";
const estadosclientes = {};

estadosclientes.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

estadosclientes.listEstadosClientes = async () => {
    const urlList = baseUrl+"/listar_estadosclientes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estadosclientes.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_estcli
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

estadosclientes.delete = async (id_estcli) => {
    const urlDelete = baseUrl+"/delete/"+id_estcli
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default estadosclientes;