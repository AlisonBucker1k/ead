import React, { Component } from 'react';
import { View, Text, StyleSheet } from 'react-native';

export default class Tela1 extends Component{
    render(){
        return(
            <View style={style.body}>
                <Text style={style.text}>Tela 01</Text>
            </View>
        );
    }
}

const style = StyleSheet.create({
    body:{
        flex:1,
        padding:20,
        justifyContent:'center',
        alignItems:'center',
        backgroundColor:'#fff',
    },
    text:{
        color:'#fff',
        fontSize:25
    }
});