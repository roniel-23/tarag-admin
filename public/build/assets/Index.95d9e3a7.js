import{_ as u}from"./Authenticated.e82b74e2.js";import{R as m,o as n,c as l,a as e,u as o,w as a,F as p,H as g,b as t,L as i,x as b,g as c,t as r,A as f}from"./app.adb44345.js";import"./ApplicationLogo.4f660ea0.js";const y=t("h2",{class:"text-xl font-semibold leading-tight text-gray-800"}," Post ",-1),k={class:"py-12"},v={class:"mx-auto max-w-7xl sm:px-6 lg:px-8"},w={class:"overflow-hidden bg-white shadow-sm sm:rounded-lg"},C={class:"p-6 bg-white border-b border-gray-200"},D={class:"mb-4"},B=c(" Posts Create "),I=t("thead",{class:"font-bold bg-gray-300 border-b-2"},[t("td",{class:"px-4 py-2"},"ID"),t("td",{class:"px-4 py-2"},"Title"),t("td",{class:"px-4 py-2"},"Description"),t("td",{class:"px-4 py-2"},"Action")],-1),L={class:"px-4 py-2"},N={class:"px-4 py-2"},P={class:"px-4 py-2"},V={class:"px-4 py-2 font-extrabold"},A=c(" Edit "),E=c("Delete"),O={__name:"Index",props:{posts:Object},setup(_){let h=d=>{f.Inertia.delete(route("posts.destroy",d))};return(d,F)=>{const x=m("pagination");return n(),l(p,null,[e(o(g),{title:"Posts"}),e(u,null,{header:a(()=>[y]),default:a(()=>[t("div",k,[t("div",v,[t("div",w,[t("div",C,[t("div",D,[e(o(i),{class:"px-6 py-2 mb-2 text-green-100 bg-green-500 rounded",href:d.route("posts.create")},{default:a(()=>[B]),_:1},8,["href"])]),t("table",null,[I,t("tbody",null,[(n(!0),l(p,null,b(_.posts.data,s=>(n(),l("tr",{key:s.id},[t("td",L,r(s.id),1),t("td",N,r(s.title),1),t("td",P,r(s.description),1),t("td",V,[e(o(i),{class:"text-green-700",href:d.route("posts.edit",s.id)},{default:a(()=>[A]),_:2},1032,["href"]),e(o(i),{onClick:H=>o(h)(s.id),class:"text-red-700"},{default:a(()=>[E]),_:2},1032,["onClick"])])]))),128))])]),e(x,{links:_.posts.links},null,8,["links"])])])])])]),_:1})],64)}}};export{O as default};
