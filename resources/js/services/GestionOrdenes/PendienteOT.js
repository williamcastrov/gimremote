import url from "../../components/Url";
const baseUrl = `${url}/api/pendienteot`;
import axios from "axios";
const pendienteot = {};

pendienteot.save = async (data) => {
    console.log("DATA : ", data.id_pot)
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

pendienteot.listpendienteot = async (id_pot) => {
    const urlList = baseUrl+"/listar_pendienteOT/"+id_pot
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

pendienteot.listpendientes = async () => {
    const urlList = baseUrl+"/listar_pendientes"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

pendienteot.update = async (data) => {
    //console.log(data);
    //console.log("DATA : ", data.id);
    const urlUpdate = baseUrl+"/update/"+data.id
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

pendienteot.delete = async (id) => {
    const urlDelete = baseUrl+"/delete/"+id
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default pendienteot;