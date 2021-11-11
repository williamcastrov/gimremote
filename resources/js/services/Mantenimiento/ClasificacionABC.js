import url from "../../components/Url";
const baseUrl = `${url}/api/clasificacionabc`;   
import axios from "axios";
const clasificacionabc = {};

clasificacionabc.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

clasificacionabc.listClasificacionabc = async () => {
    const urlList = baseUrl+"/listar_clasificacionabc"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

clasificacionabc.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_abc
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

clasificacionabc.delete = async (id_abc) => {
    const urlDelete = baseUrl+"/delete/"+id_abc
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default clasificacionabc;