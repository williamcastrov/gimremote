import url from "../../components/Url";
const baseUrl = `${url}/api/paises`;
import axios from "axios";
const pais = {};

pais.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

pais.listPaises = async () => {
    const urlList = baseUrl+"/listar_paises"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

pais.update = async (data) => {
    console.log("DATA : ", data.id_pai)
    const urlUpdate = baseUrl+"/update/"+data.id_pai
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

pais.delete = async (id_pai) => {
    const urlDelete = baseUrl+"/delete/"+id_pai
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default pais;