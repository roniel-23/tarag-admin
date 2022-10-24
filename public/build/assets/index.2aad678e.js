import{o as i,c as n,b as t,t as e,y as k,z as R,u as o,a as d,h,g as b,F as g,x as w,w as y,L as S,f as u,C,H as N,l as p,D as O,s as P,v as D,e as L,A as V}from"./app.adb44345.js";import{_ as B}from"./Authenticated.e82b74e2.js";import{S as G}from"./Spinner.b46f03cb.js";import{N as j}from"./NoData.dab6c38a.js";import{_ as T}from"./Paginator.51d73263.js";import"./ApplicationLogo.4f660ea0.js";const F={class:"text-black pl-1 mt-2"},H={class:"flex justify-between items-center px-2"},z=t("div",{class:"text-gray-400 text-xs"},"Court Name:",-1),A={class:"text-gray-700 text-base font-semibold"},E={class:"flex justify-between items-center px-2"},K=t("div",{class:"text-gray-400 text-xs"},"Room OG Name:",-1),M={class:"text-gray-700 text-base font-semibold"},U={__name:"RoomCard",props:{room:Object},setup(s){return(c,m)=>(i(),n("div",F,[t("div",H,[z,t("div",A,e(s.room.court_name),1)]),t("div",E,[K,t("div",M,e(s.room.first_name)+" "+e(s.room.last_name),1)])]))}},$=k({id:"roomPlayers",state:()=>({players:null,loading:!1,error:null}),getters:{},actions:{async fetchRoomPlayers(s){this.players=null,this.loading=!0;try{this.players=await fetch(`/api/roomplayers/${s}`).then(c=>c.json())}catch(c){this.error=c}finally{this.loading=!1}}}}),q={class:"text-xl font-bold text-center my-2 py-2 bg-orange-100"},J={class:"flex justify-between items-center"},Q=t("div",{class:"text-xs text-gray-500"},"Court Name:",-1),W={class:"text-lg font-semibold"},X={class:"flex justify-between items-center"},Y=t("div",{class:"text-xs text-gray-500"},"Room OG:",-1),Z={class:"text-lg font-semibold"},tt={class:"grid grid-cols-2 gap-3 my-2 text-white"},et={class:"grid justify-center text-center bg-orange-500 rounded-l"},st={class:"text-lg font-bold"},ot=t("div",{class:"text-xs uppercase"},[t("small",null,"Game Time")],-1),it={class:"grid justify-center gap text-center bg-orange-500 rounded-r"},nt={class:"text-lg font-bold"},at=t("div",{class:"text-xs uppercase"},[t("small",null,"Game Date")],-1),lt={class:"mt-3"},rt={key:0,class:"items-center text-center mt-3"},ct=t("p",{class:"text-sm text-gray-500 mt-3"},"Loading Players",-1),dt={key:1},_t={class:"text-sm text-gray-500 mt-3"},mt={key:2,class:"mt-3"},ft={class:"flex justify-between border-b pb-1 items-center text-lg bg-white"},ut=t("div",{class:"font-semibold"},"Players List",-1),ht={class:"font-bold text-orange-500"},xt={class:"text-xs text-gray-500"},vt={class:"h-80 overflow-auto pr-2"},gt={key:0},yt={class:"flex justify-between items-center"},bt={class:"text-xs"},pt={class:"text-base font-semibold text-gray-900"},$t={class:"text-gray-500"},wt={class:"text-base font-semibold text-gray-900"},jt={__name:"RoomInformation",props:{roomInfo:Object},setup(s){const c=s,{fetchRoomPlayers:m}=$(),{players:a,loading:x,error:_}=R($());return m(c.roomInfo.id),(v,f)=>(i(),n("div",null,[t("div",q,e(s.roomInfo.room_title),1),t("div",J,[Q,t("div",W,e(s.roomInfo.court_name),1)]),t("div",X,[Y,t("div",Z,e(s.roomInfo.first_name)+" "+e(s.roomInfo.last_name),1)]),t("div",tt,[t("div",et,[t("div",st,e(s.roomInfo.game_time)+":00",1),ot]),t("div",it,[t("div",nt,e(s.roomInfo.game_date),1),at])]),t("div",lt,[o(x)?(i(),n("div",rt,[d(G),ct])):h("",!0),o(_)?(i(),n("div",dt,[t("p",_t,e(o(_).message),1)])):h("",!0),o(a)?(i(),n("div",mt,[t("div",ft,[ut,t("div",ht,[b(e(o(a).room_players_count)+" ",1),t("small",xt,"of "+e(s.roomInfo.number_of_players),1)])]),t("div",vt,[o(a).room_players_count==0?(i(),n("div",gt,[d(j)])):h("",!0),(i(!0),n(g,null,w(o(a).room_players,(r,l)=>(i(),n("div",{class:"border-b py-1",key:r.id},[t("div",yt,[t("div",bt,[t("div",pt,[d(o(S),{href:v.route("player.show",{user_id:r.user_id})},{default:y(()=>[b(e(r.first_name)+" "+e(r.last_name),1)]),_:2},1032,["href"])]),t("div",$t,e(r.code_name),1)]),t("div",wt,e(r.position),1)])]))),128))])])):h("",!0)])]))}},It=t("h2",{class:"text-xl font-semibold leading-tight text-gray-800"}," Rooms ",-1),kt=t("div",{class:"flex justify-between my-2 items-center font-semibold"},null,-1),Rt={class:"flex justify-between"},St={class:"w-1/3"},Ct={class:"items-center"},Nt={class:"relative"},Ot=t("div",{class:"inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-600"},[t("i",{class:"fa-solid fa-search"})],-1),Pt={class:"text-start mt-3 border rounded-lg p-2 bg-white shadow-lg"},Dt=t("div",{class:"text-xl font-semibold border-b pb-2"}," Court Information ",-1),Lt={class:"w-2/3 pl-2 ml-2 border-l"},Vt={class:"grid grid-cols-2 gap-3"},Bt={class:"rounded-t-lg bg-gray-800 p-2"},Gt={class:"flex justify-between px-4 text-base text-center items-center"},Tt={class:"text-xs"},Ft={class:"flex justify-start my-2 ml-1"},Ht=["onClick"],zt=t("small",null,"Show info",-1),At=[zt],Et={class:"flex justify-end mt-2"},Xt={__name:"index",props:{rooms:Object,filter:String},setup(s){const c=s,m=u(0);let a=u(c.filter),x=u(Object),_=u(!1);u(!1);function v(f){_.value=!0,m.value+=1,x.value=f}return C(a,f=>{V.Inertia.get("/rooms",{search:f},{preserveState:!0,replace:!0})}),(f,r)=>(i(),n(g,null,[d(o(N),{title:"Rooms"}),d(B,null,{header:y(()=>[It]),default:y(()=>[kt,t("div",Rt,[t("div",St,[t("div",Ct,[t("div",Nt,[Ot,p(t("input",{"onUpdate:modelValue":r[0]||(r[0]=l=>P(a)?a.value=l:a=l),type:"search",name:"search",class:"text-sm placeholder-gray-400 pl-10 pr-4 rounded-full border border-gray-400 w-full py-2 focus:outline-none",placeholder:"Search rooms..."},null,512),[[O,o(a)]])])]),t("div",Pt,[Dt,p(d(j,null,null,512),[[D,!o(_)]]),o(_)?(i(),L(jt,{roomInfo:o(x),key:m.value},null,8,["roomInfo"])):h("",!0)])]),t("div",Lt,[t("div",Vt,[(i(!0),n(g,null,w(s.rooms.data,(l,I)=>(i(),n("div",{class:"rounded-lg text-white border-x border-b hover:ring-4",key:I},[t("div",Bt,[t("div",Gt,[t("div",null,e(l.id),1),t("div",null,e(l.room_title),1),t("div",Tt,e(l.game_time)+":00 "+e(l.game_date),1)])]),d(U,{room:l},null,8,["room"]),t("div",Ft,[t("button",{onClick:Kt=>v(l),class:"text-xs uppercase bg-green-500 rounded-full px-3 m-1 hover:ring"},At,8,Ht)])]))),128))]),t("div",Et,[d(T,{links:s.rooms.links},null,8,["links"])])])])]),_:1})],64))}};export{Xt as default};