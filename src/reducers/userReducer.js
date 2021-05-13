const initialState = {
    name:'',
    email:''
};

export default (state = initialState, action) => {

    switch(action.type){
        case 'SET_NAME':
            return {...state, name:action.payload.name};
            break;
        case 'SET_EMAIL':
            return {...state, email:action.payload.email};
            break;
    }

    return state;
}