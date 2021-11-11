import url from "../../components/Url";
const baseUrl = `${url}/api/tiposservicio`;
import axios from "axios";
const tiposservicio = {};

tiposservicio.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

tiposservicio.listTiposservicio = async () => {
    const urlList = baseUrl+"/listar_tiposservicio"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposservicio.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_tser
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

tiposservicio.delete = async (id_tser) => {
    const urlDelete = baseUrl+"/delete/"+id_tser
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default tiposservicio;