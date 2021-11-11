import url from "../../components/Url";
const baseUrl = `${url}/api/monedas`;
import axios from "axios";
const monedas = {};

monedas.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })

        return res;
}

monedas.listMonedas = async () => {
    const urlList = baseUrl+"/listar_monedas"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

monedas.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_mon
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

monedas.delete = async (id_mon) => {
    const urlDelete = baseUrl+"/delete/"+id_mon
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default monedas;