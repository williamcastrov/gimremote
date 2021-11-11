import url from "../../components/Url";
const baseUrl = `${url}/api/marcas`;   
import axios from "axios";
const marcas = {};

marcas.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

marcas.listMarcas = async () => {
    const urlList = baseUrl+"/listar_marcas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

marcas.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_mar
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

marcas.delete = async (id_mar) => {
    const urlDelete = baseUrl+"/delete/"+id_mar
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default marcas;