export * from './dataProvider'


export type TMapData = {
		building: string,
		postId: number,
		top: number,
		left: number,
	}


	export type TCardData = {
		postId: number,
		title: string,
		link: string,
		image:string
		top: number,
		left: number,
}

export type TListData = {
		postId: number,
		title: string,
		link: string,
		artists: string,
		location: string,
}
