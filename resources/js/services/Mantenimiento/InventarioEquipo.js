import url from "../../components/Url";
const baseUrl = `${url}/api/inventarioequipo`;
import axios from "axios";
const inventarioequipo = {};

inventarioequipo.save = async (data) => {
    console.log("DATA : ", data)
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

inventarioequipo.listinventarioequipo = async () => {
    const urlList = baseUrl+"/listar_inventarioequipo"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

inventarioequipo.listuninventarioequipo = async (id_inve) => {
    const urlList = baseUrl+"/get/"+id_inve
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

inventarioequipo.leerinventarioequipo = async (equipo_inve) => {
    const urlList = baseUrl+"/leerinventarioequipo/"+equipo_inve
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

inventarioequipo.update = async (data) => {
    console.log("DATA : ", data.id_inve)
    const urlUpdate = baseUrl+"/update/"+data.id_inve
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

inventarioequipo.delete = async (id_inve) => {
    const urlDelete = baseUrl+"/delete/"+id_inve
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default inventarioequipo;