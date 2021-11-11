import url from "../../components/Url";
const baseUrl = `${url}/api/actividadrealizada`;   
import axios from "axios";
const actividadrealizada = {};

actividadrealizada.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

actividadrealizada.listActividadrealizada = async () => {
    const urlList = baseUrl+"/listar_actividadrealizada"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

actividadrealizada.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_are
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

actividadrealizada.delete = async (id_are) => {
    const urlDelete = baseUrl+"/delete/"+id_are
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default actividadrealizada;