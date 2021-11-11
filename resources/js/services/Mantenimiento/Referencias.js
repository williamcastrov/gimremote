import url from "../../components/Url";
const baseUrl = `${url}/api/referencias`;   
import axios from "axios";
const referencias = {};

referencias.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

referencias.listReferencias = async () => {
    const urlList = baseUrl+"/listar_referencias"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

referencias.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_ref
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

referencias.delete = async (id_ref) => {
    const urlDelete = baseUrl+"/delete/"+id_ref
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default referencias;