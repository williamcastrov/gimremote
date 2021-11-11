import url from "../../components/Url";
const baseUrl = `${url}/api/gruposequipos`;   
import axios from "axios";
const gruposequipos = {};

gruposequipos.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

gruposequipos.listGruposequipos = async () => {
    const urlList = baseUrl+"/listar_gruposequipos"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

gruposequipos.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_grp
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

gruposequipos.delete = async (id_grp) => {
    const urlDelete = baseUrl+"/delete/"+id_grp
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default gruposequipos;