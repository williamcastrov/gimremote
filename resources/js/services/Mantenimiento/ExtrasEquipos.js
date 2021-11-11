import url from "../../components/Url";
const baseUrl = `${url}/api/extrasequipos`;
import axios from "axios";
const extrasequipos = {};

extrasequipos.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

extrasequipos.listExtrasEquipos = async () => {
    const urlList = baseUrl+"/listar_extrasequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

extrasequipos.update = async (data) => {
    //console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_ext
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

extrasequipos.delete = async (id_ext) => {
    const urlDelete = baseUrl+"/delete/"+id_ext
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default extrasequipos;