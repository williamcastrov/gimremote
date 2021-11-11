import url from "../../components/Url";
const baseUrl = `${url}/api/incremento`;   
import axios from "axios";
const incrementocanon = {};

incrementocanon.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

incrementocanon.listincrementocanon = async () => {
    const urlList = baseUrl+"/listar_incrementocanon"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

incrementocanon.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_inc
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

incrementocanon.delete = async (id_inc) => {
    const urlDelete = baseUrl+"/delete/"+id_inc
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default incrementocanon;