import url from "../../components/Url";
const baseUrl = `${url}/api/regiones`;
import axios from "axios";
const regiones = {};

regiones.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

regiones.listRegiones = async () => {
    const urlList = baseUrl+"/listar_regiones"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

regiones.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_reg
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

regiones.delete = async (id_reg) => {
    const urlDelete = baseUrl+"/delete/"+id_reg
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default regiones;