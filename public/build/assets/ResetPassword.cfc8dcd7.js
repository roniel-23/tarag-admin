import{i as c,o as f,e as w,w as n,a as o,u as e,H as _,b as r,n as V,j as g,g as b}from"./app.adb44345.js";import{_ as k}from"./Button.07451ea6.js";import{_ as v}from"./Guest.245e2d76.js";import{_ as l,a as i,b as m}from"./Label.d528c74c.js";import"./ApplicationLogo.4f660ea0.js";const x=["onSubmit"],y={class:"mt-4"},P={class:"mt-4"},$={class:"flex items-center justify-end mt-4"},S=b(" Reset Password "),U={__name:"ResetPassword",props:{email:String,token:String},setup(u){const d=u,s=c({token:d.token,email:d.email,password:"",password_confirmation:""}),p=()=>{s.post(route("password.update"),{onFinish:()=>s.reset("password","password_confirmation")})};return(h,a)=>(f(),w(v,null,{default:n(()=>[o(e(_),{title:"Reset Password"}),r("form",{onSubmit:g(p,["prevent"])},[r("div",null,[o(l,{for:"email",value:"Email"}),o(i,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e(s).email,"onUpdate:modelValue":a[0]||(a[0]=t=>e(s).email=t),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),o(m,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),r("div",y,[o(l,{for:"password",value:"Password"}),o(i,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:e(s).password,"onUpdate:modelValue":a[1]||(a[1]=t=>e(s).password=t),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(m,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),r("div",P,[o(l,{for:"password_confirmation",value:"Confirm Password"}),o(i,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:e(s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=t=>e(s).password_confirmation=t),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(m,{class:"mt-2",message:e(s).errors.password_confirmation},null,8,["message"])]),r("div",$,[o(k,{class:V({"opacity-25":e(s).processing}),disabled:e(s).processing},{default:n(()=>[S]),_:1},8,["class","disabled"])])],40,x)]),_:1}))}};export{U as default};