import{i as c,o as m,c as f,a as r,u as e,w as d,F as x,H as _,b as t,j as b,l as a,D as p}from"./app.adb44345.js";import{_ as g}from"./Authenticated.e82b74e2.js";import"./ApplicationLogo.4f660ea0.js";const h=t("h2",{class:"text-xl font-semibold leading-tight text-gray-800"}," Edit ",-1),v={class:"py-12"},w={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},y={class:"overflow-hidden bg-white shadow-sm sm:rounded-lg"},D={class:"p-6 bg-white border-b border-gray-200"},V=t("label",{for:"title"},"Title",-1),B=t("label",{for:"title"},"Description",-1),E=t("div",{class:"flex items-center mt-4"},[t("button",{class:"px-6 py-2 text-white bg-gray-900 rounded"}," Save ")],-1),M={__name:"Edit",props:{post:Object},setup(u){const l=u,o=c({title:l.post.title,description:l.post.description});let n=()=>{o.put(route("posts.update",l.post.id))};return(F,s)=>(m(),f(x,null,[r(e(_),{title:"Dashboard"}),r(g,null,{header:d(()=>[h]),default:d(()=>[t("div",v,[t("div",w,[t("div",y,[t("div",D,[t("form",{onSubmit:s[2]||(s[2]=b((...i)=>e(n)&&e(n)(...i),["prevent"]))},[t("div",null,[V,a(t("input",{type:"text","onUpdate:modelValue":s[0]||(s[0]=i=>e(o).title=i),class:"w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"},null,512),[[p,e(o).title]])]),t("div",null,[B,a(t("textarea",{name:"description",type:"text","onUpdate:modelValue":s[1]||(s[1]=i=>e(o).description=i),class:"w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600"},`\r
                                `,512),[[p,e(o).description]])]),E],32)])])])])]),_:1})],64))}};export{M as default};