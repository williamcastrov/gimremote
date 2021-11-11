import url from "../../components/Url";
const baseUrl = `${url}/api/calificacionservicio`;
import axios from "axios";
const calificacionservicio = {};

calificacionservicio.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

calificacionservicio.listcalificacionservicioot = async () => {
    const urlList = baseUrl+"/listar_calificacionservcioot"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

calificacionservicio.listunacalificacionservicio = async (ot_cse) => {
    const urlList = baseUrl+"/get/"+ot_cse
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

calificacionservicio.update = async (data) => {
    console.log("DATA : ", data.ot_cse)
    const urlUpdate = baseUrl+"/update/"+data.ot_cse
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

calificacionservicio.delete = async (ot_cse) => {
    const urlDelete = baseUrl+"/delete/"+ot_cse
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default calificacionservicio;