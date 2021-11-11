import url from "../../components/Url";
const baseUrl = `${url}/api/cambioelementos`;   
import axios from "axios";
const cambioelementos = {};

cambioelementos.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

cambioelementos.listcambioelementos = async () => {
    const urlList = baseUrl+"/listar_cambioelementos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

cambioelementos.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_cel
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

cambioelementos.delete = async (id_cel) => {
    const urlDelete = baseUrl+"/delete/"+id_cel
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default cambioelementos;