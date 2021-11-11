import url from "../../components/Url";
const baseUrl = `${url}/api/nombrecargoot`;
import axios from "axios";
const nombrecargoot = {};

nombrecargoot.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

nombrecargoot.listnombrecargoot = async () => {
    const urlList = baseUrl+"/listar_nombrecargoot"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

nombrecargoot.listunnombrecargoot = async (ot_ncot) => {
    const urlList = baseUrl+"/get/"+ot_ncot
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

nombrecargoot.update = async (data) => {
    console.log("DATA : ", data.ot_ncot)
    const urlUpdate = baseUrl+"/update/"+data.ot_ncot
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

nombrecargoot.delete = async (ot_ncot) => {
    const urlDelete = baseUrl+"/delete/"+ot_ncot
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default nombrecargoot;