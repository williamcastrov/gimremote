import url from "../../components/Url";
const baseUrl = `${url}/api/conceptososerv`;
import axios from "axios";
const conceptososerv = {};

conceptososerv.save = async (data) => {
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

conceptososerv.listConceptosOserv = async () => {
    const urlList = baseUrl+"/listar_conceptososerv"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

conceptososerv.listConceptosOservOT = async () => {
    const urlList = baseUrl+"/listar_conceptososervOT"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

conceptososerv.listConceptosOservAlistamiento = async () => {
    const urlList = baseUrl+"/listar_conceptososervalistamiento"
    const res = await axios.get(urlList)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}


conceptososerv.update = async (data) => {
    console.log(data);
    const urlUpdate = baseUrl+"/update/"+data.id_con
    const res = await axios.put(urlUpdate, data)
    .then(response=>{ return response.data; })
    .catch(error=>{ return error; })
   
    return res;
}

conceptososerv.delete = async (id_con) => {
    const urlDelete = baseUrl+"/delete/"+id_con
    const res = await axios.delete(urlDelete)
    .then(response=> { return response.data })
    .catch(error =>{ return error })

    return res;
}
  
export default conceptososerv;