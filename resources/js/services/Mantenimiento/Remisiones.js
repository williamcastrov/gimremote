import url from "../../components/Url";
const baseUrl = `${url}/api/remision`;   
import axios from "axios";
const remision = {};

remision.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

remision.listremision = async () => {
    const urlList = baseUrl+"/listar_remision"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

remision.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_rem
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

remision.delete = async (id_rem) => {
    const urlDelete = baseUrl+"/delete/"+id_rem
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default remision;