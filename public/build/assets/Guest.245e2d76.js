import{B as h}from"./ApplicationLogo.4f660ea0.js";import{d as f,o as a,e as p,w as o,r as l,n as x,u as m,L as u,f as g,c as r,b as s,a as t,g as c,h as v}from"./app.adb44345.js";import{_ as b}from"./Button.07451ea6.js";const i={__name:"NavLink",props:["href","active"],setup(n){const e=n,d=f(()=>e.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition  duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out");return(_,q)=>(a(),p(m(u),{href:n.href,class:x(m(d))},{default:o(()=>[l(_.$slots,"default")]),_:3},8,["href","class"]))}},y={class:"sticky top-0 bg-slate-200/50 border-b border-gray-100"},k={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},$={class:"flex justify-between h-16"},w={class:"flex items-center"},B={class:"shrink-0 flex items-center"},L=s("h1",{class:"text-2xl font-bold ml-3"},"TARA G!",-1),N={class:"flex"},V={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},A=c(" Home "),C={class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},z=c(" | "),G={key:0,class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},T=c(" Dashboard "),j={key:1,class:"hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"},D=c(" Log in "),E={__name:"NavigationLight",setup(n){return g(!1),(e,d)=>(a(),r("nav",y,[s("div",k,[s("div",$,[s("div",w,[s("div",B,[t(m(u),{href:e.route("guest")},{default:o(()=>[t(h,{class:"block h-9 w-auto"})]),_:1},8,["href"])]),L]),s("div",N,[s("div",V,[t(i,{href:e.route("guest"),active:e.route().current("guest")},{default:o(()=>[A]),_:1},8,["href","active"])]),s("div",C,[t(i,null,{default:o(()=>[z]),_:1})]),e.$page.props.auth.user?(a(),r("div",G,[t(i,{href:e.route("dashboard")},{default:o(()=>[t(b,null,{default:o(()=>[T]),_:1})]),_:1},8,["href"])])):(a(),r("div",j,[t(i,{href:e.route("login"),active:e.route().current("login")},{default:o(()=>[D]),_:1},8,["href","active"])]))])])])]))}},H={class:"min-h-screen bg-gray-100"},R={key:0,class:"bg-white shadow"},S={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},K={__name:"Guest",setup(n){return(e,d)=>(a(),r("div",null,[s("div",H,[t(E),e.$slots.header?(a(),r("header",R,[s("div",S,[l(e.$slots,"header")])])):v("",!0),s("main",null,[l(e.$slots,"default")])])]))}};export{K as _};
