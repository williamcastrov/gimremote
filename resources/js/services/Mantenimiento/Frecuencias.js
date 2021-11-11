import url from "../../components/Url";
const baseUrl = `${url}/api/frecuencias`;   
import axios from "axios";
const frecuencias = {};

frecuencias.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

frecuencias.listFrecuencias = async () => {
    const urlList = baseUrl+"/listar_frecuencias"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

frecuencias.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_fre
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

frecuencias.delete = async (id_fre) => {
    const urlDelete = baseUrl+"/delete/"+id_fre
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default frecuencias;