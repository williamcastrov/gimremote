import url from "../../components/Url";
const baseUrl = `${url}/api/cumplimiento`;
import axios from "axios";
const cumplimientooserv = {};

cumplimientooserv.save = async (data) => {
    console.log("DATA : ", data.id_cosv)
    const urlSave = baseUrl + "/create"
    const res = await axios.post(urlSave, data)
        .then(response => { return response.data })
        .catch(error => { return error; })
    return res;
}

cumplimientooserv.listCumplimiento = async () => {
    const urlList = baseUrl + "/listar_cumplimiento"
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.listUnCumplimiento = async (id_cosv) => {
    const urlList = baseUrl + "/get/" + id_cosv
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.leeractividad = async (actividad) => {
    console.log("ID ACTIVIDAD SERVICES : ", actividad)
    const urlList = baseUrl + "/leeractividad/" +actividad
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}


cumplimientooserv.leeactividadestotalactivas = async () => {
    const urlList = baseUrl + "/leeactividadestotalactivas"
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.listActividadActiva = async (id_cosv) => {
    const urlList = baseUrl + "/listaractividadactiva/" + id_cosv
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.listOserv = async (id_cosv) => {
    const urlList = baseUrl + "/getoser/" + id_cosv
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.leeactividadestecnico = async (operario_cosv) => {
    //console.log("DATA UNA ORDEN : ",id_otr)
    const urlList = baseUrl + "/leeactividadestecnico/" + operario_cosv
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.leetodasactividadestecnico = async (operario_cosv) => {
    //console.log("DATA UNA ORDEN : ",id_otr)
    const urlList = baseUrl + "/leetodasactividadestecnico/" + operario_cosv
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}


cumplimientooserv.update = async (data) => {
    console.log(data);
    console.log("DATA : ", data.id_actividad);
    const urlUpdate = baseUrl + "/update/" + data.id_actividad
    const res = await axios.put(urlUpdate, data)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.updatehorometro = async (data) => {
    console.log(data);
    console.log("DATA : ", data.id_actividad);
    const urlUpdate = baseUrl + "/updatehorometro/" + data.id_actividad
    const res = await axios.put(urlUpdate, data)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.pasararevision = async (id_actividad) => {
    //console.log("DATA PROGRAMADA : ", id_actividad);
    const urlUpdate = baseUrl + "/pasararevision/" + id_actividad
    const res = await axios.put(urlUpdate)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.actualizafinaltransporte = async (id_actividad) => {
    //console.log("DATA : ", data.id_actividad);
    const urlUpdate = baseUrl + "/actualizafinaltransporte/" + id_actividad
    const res = await axios.put(urlUpdate)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.actualizainiciatransporte = async (id_actividad) => {
    //console.log("DATA : ", data.id_actividad);
    const urlUpdate = baseUrl + "/actualizainiciatransporte/" + id_actividad
    const res = await axios.put(urlUpdate)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.cerraractividad = async (id_actividad) => {
    //console.log("DATA PROGRAMADA : ", id_otr);
    const urlUpdate = baseUrl + "/cerrarActividad/" + id_actividad
    const res = await axios.put(urlUpdate)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.actividadesactivasxot = async (id_cosv) => {
    const urlList = baseUrl + "/actividadesactivasxot/" + id_cosv
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.actividadestotalesxot = async (id_cosv) => {
    const urlList = baseUrl + "/actividadestotalesxot/" + id_cosv
    const res = await axios.get(urlList)
        .then(response => { return response.data; })
        .catch(error => { return error; })

    return res;
}

cumplimientooserv.delete = async (id) => {
    const urlDelete = baseUrl + "/delete/" + id
    const res = await axios.delete(urlDelete)
        .then(response => { return response.data })
        .catch(error => { return error })

    return res;
}

export default cumplimientooserv;