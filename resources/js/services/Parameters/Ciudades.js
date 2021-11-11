import url from "../../components/Url";
const baseUrl = `${url}/api/ciudades`;  
import axios from "axios";
const ciudades = {};

ciudades.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

ciudades.listCiudades = async () => {
    const urlList = baseUrl+"/listar_ciudades"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

ciudades.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_ciu
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

ciudades.delete = async (id_ciu) => {
    const urlDelete = baseUrl+"/delete/"+id_ciu
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default ciudades;